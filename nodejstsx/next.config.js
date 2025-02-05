/** @type {import('next').NextConfig} */
const nextConfig = {
  reactStrictMode: true,

  rewrites() {
    return [
      {
        source: '/api/:path*',
        destination: `${process.env.BACK}/api/:path*`,
      },
      {
        source: '/',
        destination: '/index.html',
      },
    ];
  },
};

module.exports = nextConfig;
