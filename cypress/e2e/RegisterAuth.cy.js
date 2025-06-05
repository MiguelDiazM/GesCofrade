describe("Prueba registro", () => {
  it("passes", () => {
    cy.visit("https://localhost/GesCofrade/public/index.php");
    cy.location("pathname").should("eq", "/GesCofrade/public/index.php");

    cy.contains("Registrarse").click();
    cy.location("pathname").should("eq", "/GesCofrade/app/views/signup.php");
    cy.wait(500);
    let formulario = "pruebaCypress";

    cy.get('input[name="nombre"]').type(formulario);
    cy.get('input[name="contrasena"]').type(formulario);
    cy.get('input[name="poblacion"]').type(formulario);

    cy.contains("Registrarse").click();
    cy.wait(500);
    cy.get('.login > a').click()
    cy.location("pathname").should("eq", "/GesCofrade/app/views/login.php");
  });
});
