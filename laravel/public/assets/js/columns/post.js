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
        width: "30%",
    },
    {
        data: "catalogue_id",
        name: "catalogue_id",
        title: "DANH MỤC BÀI VIẾT",
        width: "18%",
        orderable: false,
        searchable: false,
    },
    {
        data: "published_at",
        name: "published_at",
        title: "NGÀY XUẤT BẢN",
        width: "12%",
    },
    {
        data: "published",
        name: "published",
        title: "TRẠNG THÁI",
        width: "8%",
        render: (data) => {
            return data
                ? '<span class="badge text-bg-success">Hoạt động</span>'
                : '<span class="badge text-bg-danger">Ngưng hoạt động</span>';
        },
        orderable: false,
        searchable: false,
    },
];
