const columns = [
    {
        data: "id",
        name: "id",
        title: "ID | NGÀY TẠO",
        orderable: false,
        searchable: false,
        width: "12%",
    },
    {
        data: "thumbnail",
        name: "thumbnail",
        title: "ẢNH ĐẠI DIỆN",
        orderable: false,
        searchable: false,
        width: "10%",
    },
    {
        data: "title",
        name: "title",
        title: "TIÊU ĐỀ",
        width: "55%",
    },
    {
        data: "published",
        name: "published",
        title: "TRẠNG THÁI",
        width: "12%",
        render: (data) => {
            return data
                ? '<span class="badge text-bg-success">Hoạt động</span>'
                : '<span class="badge text-bg-danger">Ngưng hoạt động</span>';
        },
        orderable: false,
        searchable: false,
    },
];
