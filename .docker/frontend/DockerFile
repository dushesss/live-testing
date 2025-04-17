FROM node:18-alpine

ENV npm_config_platform=linux
ENV npm_config_arch=x64

RUN apk add --no-cache tini

WORKDIR /app

COPY package*.json ./
COPY . .
RUN npm install && npm install react-refresh --save-dev

EXPOSE 5173

ENTRYPOINT ["/sbin/tini", "--"]
CMD ["npm", "run", "dev", "--", "--host"]
