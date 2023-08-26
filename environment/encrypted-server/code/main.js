import express from "express";
import bodyParser from "body-parser";
const app = express();
const chrs = "abdehkmnpswxzABDEFGHKMNPQRSTWXZ123456789";
function getRandomKey(number) {
	return `${getRandomText(10)}//${getRandomText(7)}/${getRandomText(15)}+${getRandomText(13)}+${getRandomText(30)}/${getRandomText(30)}`;
}
function getRandomText(number) {
	let str = "";
	for (let i = 0; i < number; i++) {
		str += chrs[Math.floor(Math.random() * chrs.length)];
	}
	return str;
}

export default function main() {
    app.use(bodyParser.json());
	app.use(bodyParser.urlencoded({ extended: false }));
	app.use((error, req, res, next) => {
		res.status(400);
	});

	app.post("/", (req, res) => {
		console.log("Запрос", req.body);
		res.send(JSON.stringify([getRandomKey()]));
		res.status(200);
	});

	app.put("/", (req, res) => {
		console.log("Запрос", req.body);
		res.send(JSON.stringify([getRandomKey()]));
		res.status(200);
	});

	app.get("/", (req, res) => {
		console.log("Запрос", req.body);
		res.send(JSON.stringify([getRandomKey()]));
		res.status(200);
	});

	app.listen(8050, () => {
		console.log(`Эмулирующий сервер работает на порте 8050`);
	});
}


