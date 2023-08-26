FROM node:latest
WORKDIR /app
COPY package.json .
RUN npm i
RUN npm i --global nodemon
COPY . .
CMD ["nodemon", "/app/index.js"]