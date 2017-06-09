# pwa-template
Template files for a progressive web app, to make creating a new PWA quick and easy.


## Features:

- Service Worker
  - Offline caching (with banner that sticks to the bottom of the page when you're offline)
  - "Add to homepage" banner on mobile
- Changing page title based on page visibility
- Browser notifications
- Web app manifest
  - Custom URL bar color for Chrome on mobile
  - Splashpage when openned as an app


## Requirements:

- SSL Certificate (LetsEncrypt.org is a great source of free certificates)
- HTTPS (service worker requires HTTPS on every page it's on)


## Recommendations:

- HTTP/2
