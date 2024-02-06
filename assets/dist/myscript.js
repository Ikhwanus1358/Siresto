const flashData = $(".flash-data").data("flashdata");
const tambahFlashData = $(".tflash-data").data("tflashdata");
const loginFlashData = $(".lflash-data").data("lflashdata");

if (flashData) {
	Swal.fire({
		title: "Informasi",
		text: "Data Berhasil " + flashData,
		icon: "info",
		confirmButtonText: "Ya",
	});
}

if (tambahFlashData) {
	Swal.fire({
		title: "Peringatan",
		text: tambahFlashData,
		icon: "warning",
		confirmButtonText: "Ya",
	});
}

if (loginFlashData) {
	Swal.fire({
		title: "Peringatan",
		text: loginFlashData,
		icon: "warning",
		confirmButtonText: "Ya",
	});
}

// Tombol Hapus
$(".tombol-hapus").on("click", function (e) {
	e.preventDefault();
	const href = $(this).attr("href");

	Swal.fire({
		title: "Konfirmasi",
		text: "Apakah Anda Yakin Ingin Menghapus Data Ini?",
		icon: "question",
		showCancelButton: true,
		confirmButtonColor: "#3085d6",
		cancelButtonColor: "#d33",
		confirmButtonText: "Ya",
		cancelButtonText: "Tidak",
	}).then((result) => {
		if (result.isConfirmed) {
			document.location.href = href;
			// Swal.fire("Informasi", "Data Berhasil Dihapus", "info");
		}
	});
});

// Tombol Logout
$("#tombol-logout").on("click", function (e) {
	e.preventDefault();
	const href = $(this).attr("href");

	Swal.fire({
		title: "Konfirmasi",
		text: "Apakah Anda Yakin Ingin Logout?",
		icon: "question",
		showCancelButton: true,
		confirmButtonColor: "#3085d6",
		cancelButtonColor: "#d33",
		confirmButtonText: "Ya",
		cancelButtonText: "Tidak",
	}).then((result) => {
		if (result.isConfirmed) {
			document.location.href = href;
		}
	});
});
