const columns = [
    {
        data: "id",
        name: "id",
        title: "ID | NGÀY TẠO",
        orderable: false,
        searchable: false,
        width: "12%", // ID + Ngày: không cần nhiều
    },
    {
        data: "name",
        name: "name",
        title: "HỌ TÊN",
        width: "20%", // Tên có thể dài
    },
    {
        data: "phone",
        name: "phone",
        title: "SỐ ĐIỆN THOẠI",
        width: "12%", // Đủ hiển thị số điện thoại
    },
    {
        data: "email",
        name: "email",
        title: "Email",
        width: "20%", // Email thường dài
    },
    {
        data: "message",
        name: "message",
        title: "LỜI NHẮN",
        orderable: false,
        width: "35%", // Để rộng cho nội dung
    },
];
