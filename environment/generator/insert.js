import mssql from "mssql";

const chrs = "abdehkmnpswxzABDEFGHKMNPQRSTWXZ123456789";
function getRandomText(number) {
	let str = "'";
	for (let i = 0; i < number; i++) {
		str += chrs[Math.floor(Math.random() * chrs.length)];
	}
	return (str += "'");
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
		await insertDB(10000);
		console.log("Данные успешно занесены");
	} catch (err) {
		console.error(err);
	}
};

async function insertDB(number) {
	for (let i = 0; i < number; i++) {
		console.log(`Добавлена строка: ${i + 1}`);
		let values = `${getRandomText(99)}, ${getRandomText(99)}, ${getRandomText(99)}, ${getRandomDate()}, ${getRandomBool()}`;
		let query = `INSERT INTO src (campaign, puid, token, date, unwrap) VALUES (${values})`;
		await mssql.query(query);
	}
}

await connect();
