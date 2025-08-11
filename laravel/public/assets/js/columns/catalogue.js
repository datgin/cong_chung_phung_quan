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
        data: "name",
        name: "name",
        title: "TÊN DANH MỤC",
    },
    {
        data: "slug",
        name: "slug",
        title: "ĐƯỜNG DẪN",
    },

    {
        data: "position",
        name: "position",
        title: "THỨ TỰ",
        width: "10%",
    },
    {
        data: "is_slider",
        name: "is_slider",
        title: "LÀM SLIDER",
        width: "8%",
        render: (data) => {
            return data
                ? '<span class="badge text-bg-success">Có</span>'
                : '<span class="badge text-bg-danger">Không</span>';
        },
        orderable: false,
        searchable: false,
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
