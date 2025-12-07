window.onload = function() {
    const ui = SwaggerUIBundle({
        url: "/swagger.json",       // <- aquí la ruta relativa desde public/
        dom_id: '#swagger-ui',
        presets: [
            SwaggerUIBundle.presets.apis,
            SwaggerUIStandalonePreset
        ],
        layout: "BaseLayout"
    });
};
