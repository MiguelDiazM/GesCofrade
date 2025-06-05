describe('Inventario', () => {
     const DNI = "TESTCYPRESS";

     beforeEach(() => {
   
    cy.visit('https://localhost/GesCofrade/public/index.php')
    cy.location("pathname").should("eq", "/GesCofrade/public/index.php")
    
    cy.contains("Iniciar sesión").click();
    cy.location("pathname").should("eq", "/GesCofrade/app/views/login.php")
    cy.wait(500)
    cy.get('input[name="user"]').type("admin_admin");
    cy.wait(500)
    cy.get('input[name="password"]').type("admin");

    cy.contains("Iniciar sesión").click();
    cy.wait(500);
    cy.location("pathname").should("eq", "/GesCofrade/public/index.php")
    cy.wait(500);
    cy.get("#userIcon").click();
    cy.wait(500);
    cy.contains("Dashboard").click();

    cy.get('.list').contains("Hermanos").click();

    
});
  it('Añadir elemento', () => {
    cy.contains("Nuevo").click();

    cy.get('.form-nuevo > #dni').type(DNI);

    cy.get('.form-nuevo > #nombre').type("Elemento Prueba Cypress")

        cy.get('.form-nuevo > #apellido').type("Elemento Prueba Cypress")
        cy.get('.form-nuevo > #direccion').type("Elemento Prueba Cypress")
    cy.get('.form-nuevo > #telefono').type("666666666")


    cy.get('.form-nuevo > [type="submit"]').click();

  })

  it("Editar elemento", () => {

    cy.get(':nth-child(2) > :nth-child(6) > .btn-editar').click();

    cy.get('.form-editar > #nombre').type("Elemento Prueba Cypress MODIFICADO")

    cy.get('.form-editar > #apellido').type("Elemento Prueba Cypress MODIFICADO")
    cy.get('.form-editar > [type="submit"]').click();
  })

  it("borrar elemento", () => {
    cy.get(':nth-child(2) > :nth-child(6) > form > button > .btn-borrar').click();
  })

 
})