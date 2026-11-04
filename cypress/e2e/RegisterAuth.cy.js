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

  it("rechaza un nombre de hermandad y ciudad demasiado largos", () => {
    const nombreLargo = "Hermandad Sacramental de Prueba Cypress " + Date.now();

    cy.visit("/app/views/signup.php");
    cy.get('input[name="nombre"]').type(nombreLargo);
    cy.get('input[name="contrasena"]').type("cypress");
    cy.get('input[name="poblacion"]').type("Alcala de Guadaira");

    cy.contains("Registrarse").click();
    cy.location("pathname").should("eq", "/GesCofrade/app/views/signup.php");
    cy.contains(".bg-warning", "El nombre de la hermandad y la ciudad son demasiado largos").should("exist");
  });
});
