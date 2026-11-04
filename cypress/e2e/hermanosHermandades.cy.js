describe("Hermanos en varias hermandades", () => {
  // DNI y segunda hermandad únicos en cada ejecución
  const DNI = "CYM" + Date.now();
  const otra = "cyh" + Date.now();
  const usuarioOtra = otra + "_" + otra;
  const datosOriginales = "Original|Apellido Original|Calle Original|600000000";
  let idOtra;

  const hermandadesDe = () =>
    cy.sql(`SELECT id_hermandad FROM hermanos WHERE DNI = '${DNI}'`).then((h) => JSON.parse(h));
  const datosDe = () =>
    cy.sql(`SELECT CONCAT_WS('|', nombre, apellido, direccion, telefono) FROM hermanos WHERE DNI = '${DNI}'`);
  const filasDe = () => cy.sql(`SELECT COUNT(*) FROM hermanos WHERE DNI = '${DNI}'`);

  const altaHermano = (nombre) => {
    cy.visit("/app/views/hermanos.php");
    cy.contains("Nuevo").click();
    cy.get(".form-nuevo > #dni").type(DNI);
    cy.get(".form-nuevo > #nombre").type(nombre);
    cy.get(".form-nuevo > #apellido").type("Apellido " + nombre);
    cy.get(".form-nuevo > #direccion").type("Calle " + nombre);
    cy.get(".form-nuevo > #telefono").type("600000000");
    cy.get('.form-nuevo > [type="submit"]').click();
  };

  before(() => {
    // Segunda hermandad con su propio usuario
    cy.visit("/app/views/signup.php");
    cy.get('input[name="nombre"]').type(otra);
    cy.get('input[name="contrasena"]').type(otra);
    cy.get('input[name="poblacion"]').type(otra);
    cy.contains("Registrarse").click();
    cy.location("pathname").should("eq", "/GesCofrade/app/views/login.php");
    cy.sql(`SELECT id_hermandad FROM hermandad WHERE nombre = '${otra}'`).then((id) => {
      idOtra = Number(id);
    });
  });

  after(() => {
    cy.sql(`DELETE FROM hermanos WHERE DNI = '${DNI}'`);
    cy.sql(`DELETE FROM hermandad WHERE nombre = '${otra}'`);
  });

  it("da de alta un DNI nuevo en la hermandad actual", () => {
    cy.login();
    altaHermano("Original");

    cy.contains("td", DNI).should("exist");
    hermandadesDe().should("deep.equal", [13]);
    datosDe().should("eq", datosOriginales);
  });

  it("rechaza el mismo DNI en la misma hermandad sin tocar sus datos", () => {
    cy.login();
    altaHermano("Duplicado");

    cy.location("search").should("contain", "err_dni");
    cy.contains("Ya existe un hermano con ese DNI en esta hermandad").should("exist");
    filasDe().should("eq", "1");
    hermandadesDe().should("deep.equal", [13]);
    datosDe().should("eq", datosOriginales);
  });

  it("asocia el DNI existente a otra hermandad sin duplicar ni sobrescribir sus datos", () => {
    cy.login(usuarioOtra, otra);
    altaHermano("Otra");

    cy.contains("td", DNI).parent().should("contain", "Original");
    filasDe().should("eq", "1");
    hermandadesDe().then((h) => expect(h).to.deep.equal([13, idOtra]));
    datosDe().should("eq", datosOriginales);
  });

  it("no lo asocia dos veces a la misma hermandad", () => {
    cy.login(usuarioOtra, otra);
    altaHermano("Otra");

    cy.contains("Ya existe un hermano con ese DNI en esta hermandad").should("exist");
    hermandadesDe().then((h) => expect(h).to.deep.equal([13, idOtra]));
    datosDe().should("eq", datosOriginales);
  });

  it("edita los datos del hermano desde una de sus hermandades", () => {
    cy.login();
    cy.visit("/app/views/hermanos.php");
    cy.contains("td", DNI).parent().find(".btn-editar").click();
    cy.get(".form-editar > #nombre").clear().type("Editado");
    cy.get('.form-editar > [type="submit"]').click();

    cy.contains("td", DNI).parent().should("contain", "Editado");
    datosDe().should("eq", "Editado|Apellido Original|Calle Original|600000000");
    hermandadesDe().then((h) => expect(h).to.deep.equal([13, idOtra]));
  });

  it("al quitarlo de una hermandad sigue perteneciendo a las demás", () => {
    cy.login(usuarioOtra, otra);
    cy.visit("/app/views/hermanos.php");
    cy.contains("td", DNI).parent().find(".btn-borrar").click();

    cy.contains("td", DNI).should("not.exist");
    filasDe().should("eq", "1");
    hermandadesDe().should("deep.equal", [13]);

    // Cerrar la sesión de la otra hermandad antes de entrar con la primera
    cy.clearCookies();
    cy.login();
    cy.visit("/app/views/hermanos.php");
    cy.contains("td", DNI).should("exist");
  });

  it("una hermandad a la que no pertenece no puede editarlo ni borrarlo", () => {
    cy.login(usuarioOtra, otra);
    cy.visit("/app/views/hermanos.php");
    cy.contains("td", DNI).should("not.exist");

    cy.get('.form-nuevo input[name="csrf"]').invoke("val").then((csrf) => {
      const peticion = (body) =>
        cy.request({ method: "POST", url: "/app/controllers/hermanosLogic.php", form: true, body: { csrf, ...body } });
      peticion({ control: "editar", dni: DNI, nombre: "Intruso", apellido: "X", direccion: "X", telefono: "1" });
      peticion({ control: "borrar", dni: DNI });
    });

    datosDe().should("eq", "Editado|Apellido Original|Calle Original|600000000");
    hermandadesDe().should("deep.equal", [13]);
  });
});
