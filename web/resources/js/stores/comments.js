import { defineStore } from "pinia";

export const useCommentsStore = defineStore("comments", {
    state: () => ({
        commentList: [],
    }),
    actions: {
        async fetchComments(photoId) {
            try {
                const response = await axios.get(
                    `/api/photos/${photoId}/comments`
                );
                this.commentList = response.data;
            } catch (error) {
                console.error(error);
            }
        },
        async addComment(photoId, content) {
            try {
                await axios.post(`/photos/${photoId}/comments`, {
                    content,
                });
                this.fetchComments(photoId);
            } catch (error) {
                console.error(error);
            }
        },
    },
});
