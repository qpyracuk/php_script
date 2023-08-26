import mssql from "mssql";
import fs from 'fs';
let data = [
	fs.readFileSync("./environment/generator/campaign.txt").toString().split("\n"),
	fs.readFileSync("./environment/generator/puid.txt").toString().split("\n"),
	fs.readFileSync("./environment/generator/token.txt").toString().split("\n"),
];

async function insertDB() {
	for (let i = 0; i < data[0].length; i++) {
		console.log(`Добавлена строка: ${i + 1}`);
        let values = `'${data[0][i]}', '${data[1][i]}', '${data[2][i]}', ${getRandomDate()}, ${getRandomBool()}`;
		let query = `INSERT INTO src (campaign, puid, token, date, unwrap) VALUES (${values})`;
		await mssql.query(query);
	}
}

function getRandomDate() {
	let date = new Date(Date.now() - Math.floor(Math.random() * 31536000000));
	return `\'${date.toISOString()}\'`;
}

function getRandomBool() {
	return Math.floor(Math.random() * 2);
}

const connect = async () => {
	try {
		await mssql.connect("Server=0.0.0.0,1433;Database=master;User Id=SA;Password=Yapillac1;Encrypt=false");
		console.log("Установлено соединение с БД");
		await insertDB();
		console.log("Данные успешно занесены");
	} catch (err) {
		console.error(err);
	}
};



await connect();
