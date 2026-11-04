describe("Inventario", () => {
  // Referencia única en cada ejecución; los tests trabajan siempre sobre esa fila
  const referenciaElemento = "CY" + Date.now();
  const fila = () => cy.contains("td", referenciaElemento).parent();

  beforeEach(() => {
    cy.login();
    cy.visit("/app/views/dashboard.php");
    cy.get(".list").contains("Inventario").click();
    cy.location("pathname").should("eq", "/GesCofrade/app/views/inventario.php");
  });

  it("Añadir elemento", () => {
    cy.contains("Nuevo").click();

    cy.get(".form-nuevo > #referencia").type(referenciaElemento);
    cy.get(".form-nuevo > #elemento").type("Elemento Prueba Cypress");
    cy.get(".form-nuevo > #descripcion").type("Elemento Prueba Cypress");

    cy.get('.form-nuevo > [type="submit"]').click();
    fila().should("contain", "Elemento Prueba Cypress");
  });

  it("Editar elemento", () => {
    fila().find(".btn-editar").click();
    cy.get(".form-editar > #referencia").should("have.value", referenciaElemento);

    cy.get(".form-editar > #elemento").clear().type("Elemento Prueba Cypress MODIFICADO");
    cy.get(".form-editar > #descripcion").clear().type("Elemento Prueba Cypress MODIFICADO");
    cy.get('.form-editar > [type="submit"]').click();

    fila().should("contain", "Elemento Prueba Cypress MODIFICADO");
  });

  it("borrar elemento", () => {
    fila().find(".btn-borrar").click();
    cy.contains("td", referenciaElemento).should("not.exist");
  });
});
