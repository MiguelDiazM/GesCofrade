describe("Prueba Login", () => {
  it("inicia y cierra sesión desde la página principal", () => {
    cy.visit("/public/index.php");

    cy.contains("Iniciar sesión").click();
    cy.location("pathname").should("eq", "/GesCofrade/app/views/login.php");
    cy.get('input[name="user"]').type("admin_admin");
    cy.get('input[name="password"]').type("admin");

    cy.contains("Iniciar sesión").click();
    cy.location("pathname").should("eq", "/GesCofrade/public/index.php");
    cy.get("#userIcon").click();
    cy.contains("Cerrar sesión").click();

    cy.location("pathname").should("eq", "/GesCofrade/public/index.php");
    cy.contains("Iniciar sesión").should("exist");
  });

  it("muestra un error con una contraseña incorrecta", () => {
    cy.visit("/app/views/login.php");
    cy.get('input[name="user"]').type("admin_admin");
    cy.get('input[name="password"]').type("incorrecta");
    cy.get('input[type="submit"]').click();

    cy.location("pathname").should("eq", "/GesCofrade/app/views/login.php");
    cy.contains(".bg-warning", "La contraseña no coincide.").should("exist");
  });

  it("redirige al login al abrir una página privada sin sesión", () => {
    cy.visit("/app/views/dashboard.php");
    cy.location("pathname").should("eq", "/GesCofrade/app/views/login.php");
  });
});
