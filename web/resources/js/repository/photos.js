export default {
    getPhoto() {
        return new Promise((resolve, reject) => {
            axios
                .get("/api/photos")
                .then((res) => {
                    const resData = res.data;
                    resolve(resData);
                })
                .catch((error) => {
                    reject(error);
                });
        });
    },
    postPhoto(file) {
        return new Promise((resolve, reject) => {
            let formData = new FormData();
            formData.append("photo", file);

            axios
                .post("/photos/add", formData, {
                    headers: {
                        "Content-Type": "multipart/form-data",
                    },
                })
                .then((res) => {
                    resolve(res);
                })
                .catch((error) => {
                    reject(error);
                });
        });
    },
};
