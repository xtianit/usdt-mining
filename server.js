const express = require("express");
const { createProxyMiddleware } = require("http-proxy-middleware");

const app = express();
const port = 3000; // Choose a suitable port number

// Enable CORS
app.use((req, res, next) => {
    res.setHeader("Access-Control-Allow-Origin", "*");
    res.setHeader("Access-Control-Allow-Methods", "GET, POST, OPTIONS");
    res.setHeader("Access-Control-Allow-Headers", "Content-Type");
    next();
});

// Proxy WebSocket connections
app.use(
    "/socket.io",
    createProxyMiddleware({
        target: "https://stream.binance.com",
        changeOrigin: true,
        ws: true,
    })
);

app.listen(port, () => {
    console.log(`Proxy server listening on port ${port}`);
});
