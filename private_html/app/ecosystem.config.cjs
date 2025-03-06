module.exports = {
  apps: [
    {
      name: "astro-app",
      script: "node ./dist/server/entry.mjs",
      cwd: "/home/1415157.cloudwaysapps.com/hueucwstyh/private_html/app",
      instances: "1",
      exec_mode: "fork",
      env: {
        PORT: 3000,
        HOST: "0.0.0.0",
        NODE_ENV: "production",
        PUBLIC_API_BASE_URL:
          "https://phpstack-165573-5240861.cloudwaysapps.com/nm-metrica",
      },
      max_memory_restart: "1G",
      error_file: "../logs/err.log",
      out_file: "../logs/out.log",
      time: true,
    },
  ],
};
