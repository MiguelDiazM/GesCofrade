describe('Prueba Login', () => {
  it('passes', () => {
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
    cy.contains("Cerrar sesión").click();

    
  })

 
})