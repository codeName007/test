FROM node:latest

MAINTAINER Vladimir Kovpak <cn007b@gmail.com>

ENV NODE_ENV=production
ENV NODE_PORT=3000

COPY ./healthCheck.js /app/healthCheck.js
WORKDIR /app
# VOLUME ["/app"]

RUN ls -la /app/healthCheck.js

EXPOSE $NODE_PORT
# EXPOSE 3000

ENTRYPOINT ["node", "/app/healthCheck.js"]
