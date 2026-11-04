const { defineConfig } = require("cypress");

module.exports = defineConfig({
  e2e: {
    baseUrl: "https://localhost/GesCofrade",
    env: {
      // Cliente MySQL que usan los tests para comprobar la BD; se puede cambiar con CYPRESS_mysql
      mysql: "C:/xampp/mysql/bin/mysql.exe -uroot gescofrade",
    },
    setupNodeEvents(on, config) {
      // implement node event listeners here
    },
    viewportWidth: 1920,
    viewportHeight: 1080,
  },
});
