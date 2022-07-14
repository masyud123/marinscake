// ************************************************
// Shopping Cart API
// ************************************************

var shoppingCart = (function () {
	// =============================
	// Private methods and propeties
	// =============================
	cart = [];

	// Constructor
	function Item(name, price, count, idProduk) {
		this.name = name;
		this.price = price;
		this.count = count;
		this.idProduk = idProduk;
	}

	// Save cart
	function saveCart() {
		sessionStorage.setItem("shoppingCart", JSON.stringify(cart));
	}

	// Load cart
	function loadCart() {
		cart = JSON.parse(sessionStorage.getItem("shoppingCart"));
	}
	if (sessionStorage.getItem("shoppingCart") != null) {
		loadCart();
	}

	// =============================
	// Public methods and propeties
	// =============================
	var obj = {};

	// Add to cart
	obj.addItemToCart = function (name, price, count,idProduk) {
		for (var item in cart) {
			if (cart[item].name === name) {
				cart[item].count++;
				saveCart();
				return;
			}
		}
		var item = new Item(name, price, count,idProduk);
		cart.push(item);
		saveCart();
	};
	
	// Set count from item
	obj.setCountForItem = function (name, count) {
		for (var i in cart) {
			if (cart[i].name === name) {
				cart[i].count = count;
				//console.log(count);
				break;
			}
		}
	};
	// Remove item from cart
	obj.removeItemFromCart = function (name) {
		for (var item in cart) {
			if (cart[item].name === name) {
				cart[item].count--;
				if (cart[item].count === 0) {
					cart.splice(item, 1);
				}
				break;
			}
		}
		saveCart();
	};

	// Remove all items from cart
	obj.removeItemFromCartAll = function (name) {
		for (var item in cart) {
			if (cart[item].name === name) {
				cart.splice(item, 1);
				break;
			}
		}
		saveCart();
	};

	// Clear cart
	obj.clearCart = function () {
		cart = [];
		saveCart();
	};

	// Count cart
	obj.totalCount = function () {
		var totalCount = 0;
		for (var item in cart) {
			totalCount += cart[item].count;
		}
		return totalCount;
	};

	// Total cart
	obj.totalCart = function () {
		var totalCart = 0;
		for (var item in cart) { 
			totalCart += cart[item].price * cart[item].count;
		}
		return Number(totalCart.toFixed(2));
	};

	// List cart
	obj.listCart = function () {
		var cartCopy = [];
		for (i in cart) {
			item = cart[i];
			itemCopy = {};
			for (p in item) {
				itemCopy[p] = item[p];
			}
			itemCopy.total = Number(item.price * item.count).toFixed(2);
			cartCopy.push(itemCopy);
		}
		return cartCopy;
	};

	// cart : Array
	// Item : Object/Class
	// addItemToCart : Function
	// removeItemFromCart : Function
	// removeItemFromCartAll : Function
	// clearCart : Function
	// countCart : Function
	// totalCart : Function
	// listCart : Function
	// saveCart : Function
	// loadCart : Function
	return obj;
})();

// *****************************************
// Triggers / Events
// *****************************************
// Add item
$(".add-to-cart").click(function (event) {
	let stok = $('#stok'+$(this).data("id")).val();
	let jumlah = parseInt($('#jumlah'+$(this).data("id")).val());

	if(jumlah !== 'undefined'){
		if(stok <= jumlah){
			swal('Gagal','Stok tidak mencukupi','error');
		}else{
			event.preventDefault();
			var name = $(this).data("name");
			var id = $(this).data("id");
			
			var price = Number($(this).data("price"));
			shoppingCart.addItemToCart(name, price, 1,id);
			displayCart();
		}
	}
	// event.preventDefault();
	// var name = $(this).data("name");
	// var id = $(this).data("id");
	
	// var price = Number($(this).data("price"));
	// shoppingCart.addItemToCart(name, price, 1,id);
	// displayCart();
});

// Clear items
$(".clear-cart").click(function () {
	shoppingCart.clearCart();
	displayCart();
});

function displayCart() {
	var cartArray = shoppingCart.listCart();
	var output = "";
	ab = 1; ac = 1; ad = 1; ag = 1;
	for (var i in cartArray) {
		output +=		
			"<input type='text' style='width:max-content;border:0;background:white' name='idProduk[" + ag++ + "]' value='"+ cartArray[i].idProduk +"' hidden>"+
			"<div class='row py-2 border-bottom text-dark'>"+
				"<div class='col-4 my-auto'>"+
					"<input type='text' style='width:max-content;border:0;background:white' name='namaProduk[" + ab++ + "]' value='" + cartArray[i].name.replace(/\_/g, ' ') +"' readonly>"+
				"</div>"+
				"<div class='col-3 my-auto text-center'>"+
					"<div class='d-flex justify-content-start pl-0 ml-0'>"+
						"<button type='button' class='minus-item bg-white text-dark m-0 p-0' style='border:none' data-name=" + cartArray[i].name + ">-</button>"+
						"<input type='number' id='jumlah"+ cartArray[i].idProduk +"' max='3' class='item-count mx-2' name='jumlahProduk[" + ac++ + "]' style='width:50px;text-align: center;border:solid 1px #e4e6fc' data-id='"+ cartArray[i].idProduk +"' data-name='" + cartArray[i].name + "' value='" + cartArray[i].count + "'>"+
						"<button type='button' class='plus-item bg-white text-dark p-0 m-0' style='border:none' data-id='"+ cartArray[i].idProduk +"' data-name=" + cartArray[i].name + ">+</button>"+
					"</div>"+
				"</div>"+
				"<div class='col-4 my-auto'>"+
					"<input type='text' name='totalProduk[" + ad++ + "]' style='width:max-content;border:0;background:white' value='Rp. " + cartArray[i].total + "' 	readonly>"+
				"</div>"+
				"<div class='col-1 my-auto'>"+
					"<button type='button' class='delete-item bg-danger border-0 rounded px-2 text-white' data-name=" + cartArray[i].name + ">x</button>"+
				"</div>"+
			"</div>";
	}
	$(".show-cart").html(output);
	$("#total-cart").val(shoppingCart.totalCart());
	$(".total-count").html(shoppingCart.totalCount());
}

// Delete item button

$(".show-cart").on("click", ".delete-item", function (event) {
	var name = $(this).data("name");
	shoppingCart.removeItemFromCartAll(name);
	displayCart();
});

// -1
$(".show-cart").on("click", ".minus-item", function (event) {
	var name = $(this).data("name");
	shoppingCart.removeItemFromCart(name);
	displayCart();
});
// +1
$(".show-cart").on("click", ".plus-item", function (event) {
	let stok = $('#stok'+$(this).data("id")).val();
	let jumlah = parseInt($('#jumlah'+$(this).data("id")).val());
	if(stok <= jumlah){
		swal('Gagal','Stok tidak mencukupi','error');
	}else{
		var name = $(this).data("name");
		shoppingCart.addItemToCart(name);
		displayCart();
	}
	// var name = $(this).data("name");
	// shoppingCart.addItemToCart(name);
	// displayCart();
});

// Item count input
$(".show-cart").on("change", ".item-count", function (event) {
	let stok = $('#stok'+$(this).data("id")).val();
	let jumlah = parseInt($('#jumlah'+$(this).data("id")).val());
	if(stok < jumlah){
		swal('Gagal','Stok tidak mencukupi','error');
		$('#jumlah'+$(this).data("id")).val(stok);
		var name = $(this).data("name");
		var count = Number($(this).val());
		shoppingCart.setCountForItem(name, count);
		displayCart();	
	}else{
		var name = $(this).data("name");
		var count = Number($(this).val());
		shoppingCart.setCountForItem(name, count);
		displayCart();
	}
	// var name = $(this).data("name");
	// var count = Number($(this).val());
	// shoppingCart.setCountForItem(name, count);
	// displayCart();
});

displayCart();
