export default {
	methods: {
        $showTableData(_url) {
            axios.get(_url).then(res => {
                this.entityTableResults = res.data.data ?? [];
            });
        },

        $loadPagination(_page) {
            if (typeof _page !== 'undefined' && _page !== null) {
                axios.get(`${this.resourceUrl}&page=${_page}`).then(res => {
                    this.entityTableResults = res.data.data ?? [];
                });
            }
        },

        $refreshTable(_form = ''){
            switch (_form) {
                case "product-create-or-update-modal":
                    Fire.$emit(`refreshProductTable`);
                    break;
            }
        },

		$makeSweetAlert(type, msg) {
            Swal.fire({
				icon: type,
				text: msg,
				timer: 1500,
                position: 'bottom-right',
                toast: true,
                showCancelButton: false,
                showConfirmButton: false
			})
		},
	},
}
