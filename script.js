console.log("HIER");

setTimeout(tryUpdate, 4000);

function tryUpdate() {
	console.log("Fetching latest state...");
	fetch("./hash.php")
		.then(response => {
			if (!response.ok) {
				throw new Error("Dicker javascript error idk\n" + response.status);
			}
			return response.json();
		})
		.then(data => {
			if (window.sessionStorage.getItem("hash") != String(data["hash"])) {
				console.log("New state, reloading!");
				window.sessionStorage.setItem("hash", String(data["hash"]));
				window.location.reload();
			} else {
				console.log("No new state.");
			}
		})
		.catch(error => console.log("Dicker javascript error\n" + error));
		setTimeout(tryUpdate, 4000);
}

function tryMove() {
	let to = prompt("Neue Position?");
	Array.from(document.getElementsByClassName("to")).forEach((elem) => elem.value = to);
}

function login() {
	let pw = prompt("Passwort:");
	document.cookie = "pw=" + pw;
}
