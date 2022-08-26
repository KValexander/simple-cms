window.onload = () => {
	let item = document.querySelector("nav");

	/* Menu */
	document.getElementById("dot").onclick = () => {
		item.style.height = (!item.clientHeight) ? "auto" : "0px";
	};

	/* Resize */
	window.onresize = () => {
		item.style.height = (window.innerWidth >= 720) ? "auto" : "0px";
	};

};

/* Add field */
function add_field() {
	let fields, count;

	fields = document.querySelector(".fields");
	count  = document.querySelectorAll(".fields > *").length;
	
	fields.insertAdjacentHTML("beforeEnd", `
		<div class="triple">
			<input type="text" placeholder="Название поля" name="fields[${count}][name]" required></input>
			<select name="fields[${count}][type]" required>
				<option value="" selected disabled>Тип данных</option>
				<option value="INT">Число</option>
				<option value="TEXT">Текст</option>
			</select>
			<input type="button" onclick="delete_field(${count})" value="Удалить">
		</div>
	`);
}

/* Delete field */
function delete_field(field) {
	let item = document.getElementsByName(`fields[${field}][name]`);
	item = item[0].parentElement;
	item.outerHTML = "";
}

/* Change path */
function change_path() {
	document.querySelector("[name=path]").disabled = "";
}

/* Change content */
function change_content(id) {
	let items, item;

	/* URL */
	location.search = "?r="+id;
	
	/* Hide items */
	items = document.querySelectorAll("#contents > div");
	for(let i = 0; i < items.length; i++) {
		items[i].style.display = "none";
	}

	/* Show item */
	item = document.querySelector("#contents #" + id);
	item.style.display = "block";

}