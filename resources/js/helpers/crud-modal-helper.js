export default {
    methods: {
        $showCreateOrUpdateModal(_formType, _modalID, _formObj, _formData = null){
            switch (_formType) {
                case "create":
                    this.addMode = true;
                    break;
                case "edit":
                    this.addMode = false;
                    _formObj.fill(_formData);
                    break;
            }
            $(`#${_modalID}`).modal("show");
        },

        $handleAction(actionName, data = null) {
            this.createOrUpdateForm.reset();
            this.createOrUpdateForm.clear();
            switch(actionName) {
                case "create":
                    this.$showCreateOrUpdateModal("create", this.createOrUpdateModalID, this.createOrUpdateForm);
                    break;
                case "edit":
                    this.$showCreateOrUpdateModal("edit", this.createOrUpdateModalID, this.createOrUpdateForm, data);
                    break;
                case "delete":
                    this.$destroyMethod(`${this.resourceUrl}/${data.id}`, this.createOrUpdateModalID, this.createOrUpdateForm, data);
                    break;
            }
        },

        $storeMethod(_url, _modalID) {
            console.log("$storeMethod");
            NProgress.start();
            this.form.post(_url)
                .then((res) => {
                    if(res.status == 200){
                        $(`#${_modalID}`).modal("hide");
                        this.$refreshTable(_modalID)
                        this.$makeSweetAlert('success', 'data created successfully')
                    }else{
                        this.$makeSweetAlert('error', 'data not created')
                    }
                }).catch((res) =>{
                    this.$makeSweetAlert('error', res)
                });
            NProgress.done();
        },

        $updateMethod(_url, _modalID) {
            console.log("$updateMethod");
            NProgress.start();
            this.form.put(_url)
                .then((res) => {
                    if(res.status == 200){
                        $(`#${_modalID}`).modal("hide");
                        this.$refreshTable(_modalID)
                        this.$makeSweetAlert('success', 'data updated successfully')
                    }else{
                        this.$makeSweetAlert('error', 'data not updated')
                    }
                }).catch((res) =>{
                    this.$makeSweetAlert('error', res)
                });
            NProgress.done();
        },

        $destroyMethod(_url, _modalID, _formObj, _formData) {
            console.log("$destroyMethod");
            NProgress.start();
            Swal.fire({
                    title: "are you sure about deleting this record",
                    text: "this record cannot retrieved",
                    icon: "warning",
                    showDenyButton: true,
                    showCancelButton: false,
                    confirmButtonText: "yes",
                    denyButtonText: "no",
                })
                .then((result) => {
                    if (result.value) {
                        _formObj.fill(_formData);
                        _formObj.delete(_url)
                            .then((res) => {
                                if(res.status == 200){
                                    this.$refreshTable(_modalID);
                                    this.$makeSweetAlert('success', 'data deleted successfully')
                                }else{
                                    this.$makeSweetAlert('error', 'data not updated')
                                }
                            }).catch((res) => {
                                this.$makeSweetAlert('error', res)
                            });
                    }
                    NProgress.done();
                });
        },
    },
};
