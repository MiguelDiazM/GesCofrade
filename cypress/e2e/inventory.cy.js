describe("Inventario", () => {
  const referenciaElemento = "TESTCYPRESS";

  beforeEach(() => {
    cy.visit("https://localhost/GesCofrade/public/index.php");
    cy.location("pathname").should("eq", "/GesCofrade/public/index.php");

    cy.contains("Iniciar sesión").click();
    cy.location("pathname").should("eq", "/GesCofrade/app/views/login.php");
    cy.wait(500);
    cy.get('input[name="user"]').type("admin_admin");
    cy.wait(500);
    cy.get('input[name="password"]').type("admin");

    cy.contains("Iniciar sesión").click();
    cy.wait(500);
    cy.location("pathname").should("eq", "/GesCofrade/public/index.php");
    cy.wait(500);
    cy.get("#userIcon").click();
    cy.wait(500);
    cy.contains("Dashboard").click();

    cy.get(".list").contains("Inventario").click();
  });
  it("Añadir elemento", () => {
    cy.contains("Nuevo").click();

    cy.get(".form-nuevo > #referencia").type(referenciaElemento);

    cy.get(".form-nuevo > #elemento").type("Elemento Prueba Cypress");

    cy.get(".form-nuevo > #descripcion").type("Elemento Prueba Cypress");
    cy.get('.form-nuevo > [type="submit"]').click();
  });

  it("Editar elemento", () => {
    cy.get(':nth-child(11) > :nth-child(4) > .btn-editar').click();

    cy.get(".form-editar > #elemento").type(
      "Elemento Prueba Cypress MODIFICADO"
    );

    cy.get(".form-editar > #descripcion").type(
      "Elemento Prueba Cypress MODIFICADO"
    );
    cy.get('.form-editar > [type="submit"]').click();
  });

  it("borrar elemento", () => {
    cy.get(':nth-child(11) > :nth-child(4) > #formulario-borrar > .btn-borrar').click();
    cy.contains(referenciaElemento).should("not.exist");
  });
});
