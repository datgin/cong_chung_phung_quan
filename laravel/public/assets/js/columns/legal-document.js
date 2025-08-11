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
        data: "title",
        name: "title",
        title: "TIÊU ĐỀ",
        width: "45%",
    },
    {
        data: "file",
        name: "file",
        title: "Tài liệu",
        width: "20%",
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
