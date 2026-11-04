describe("Prueba registro", () => {
  it("registra una hermandad y permite iniciar sesión con su usuario", () => {
    // Nombre único en cada ejecución para no chocar con registros anteriores
    const formulario = "cy" + Date.now();

    cy.visit("/public/index.php");
    cy.contains("Registrarse").click();
    cy.location("pathname").should("eq", "/GesCofrade/app/views/signup.php");

    cy.get('input[name="nombre"]').type(formulario);
    cy.get('input[name="contrasena"]').type(formulario);
    cy.get('input[name="poblacion"]').type(formulario);

    cy.contains("Registrarse").click();
    cy.location("pathname").should("eq", "/GesCofrade/app/views/login.php");

    cy.login(formulario + "_" + formulario, formulario);
  });
});
