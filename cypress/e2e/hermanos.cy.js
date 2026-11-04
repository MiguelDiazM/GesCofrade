describe("Hermanos", () => {
  // DNI único en cada ejecución; los tests trabajan siempre sobre esa fila
  const DNI = "CY" + Date.now();
  const fila = () => cy.contains("td", DNI).parent();

  beforeEach(() => {
    cy.login();
    cy.visit("/app/views/dashboard.php");
    cy.get(".list").contains("Hermanos").click();
    cy.location("pathname").should("eq", "/GesCofrade/app/views/hermanos.php");
  });

  it("Añadir elemento", () => {
    cy.contains("Nuevo").click();

    cy.get(".form-nuevo > #dni").type(DNI);
    cy.get(".form-nuevo > #nombre").type("Elemento Prueba Cypress");
    cy.get(".form-nuevo > #apellido").type("Elemento Prueba Cypress");
    cy.get(".form-nuevo > #direccion").type("Elemento Prueba Cypress");
    cy.get(".form-nuevo > #telefono").type("666666666");

    cy.get('.form-nuevo > [type="submit"]').click();
    fila().should("contain", "Elemento Prueba Cypress").and("contain", "666666666");
  });

  it("Editar elemento", () => {
    fila().find(".btn-editar").click();
    cy.get(".form-editar > #dni").should("have.value", DNI);

    cy.get(".form-editar > #nombre").clear().type("Elemento Prueba Cypress MODIFICADO");
    cy.get(".form-editar > #apellido").clear().type("Elemento Prueba Cypress MODIFICADO");
    cy.get('.form-editar > [type="submit"]').click();

    fila().should("contain", "Elemento Prueba Cypress MODIFICADO");
  });

  it("borrar elemento", () => {
    fila().find(".btn-borrar").click();
    cy.contains("td", DNI).should("not.exist");
  });
});
