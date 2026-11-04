// ***********************************************
// This example commands.js shows you how to
// create various custom commands and overwrite
// existing commands.
//
// For more comprehensive examples of custom
// commands please read more here:
// https://on.cypress.io/custom-commands
// ***********************************************
//
//
// -- This is a parent command --
// Cypress.Commands.add('login', (email, password) => { ... })
//
//
// -- This is a child command --
// Cypress.Commands.add('drag', { prevSubject: 'element'}, (subject, options) => { ... })
//
//
// -- This is a dual command --
// Cypress.Commands.add('dismiss', { prevSubject: 'optional'}, (subject, options) => { ... })
//
//
// -- This will overwrite an existing command --
// Cypress.Commands.overwrite('visit', (originalFn, url, options) => { ... })

Cypress.Commands.add("login", (usuario = "admin_admin", contrasena = "admin") => {
  cy.visit("/app/views/login.php");
  cy.get('input[name="user"]').type(usuario);
  cy.get('input[name="password"]').type(contrasena);
  cy.get('input[type="submit"]').click();
  cy.location("pathname").should("eq", "/GesCofrade/public/index.php");
});
