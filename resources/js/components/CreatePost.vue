<template>
    <div>
        <form class="w-full max-w-2xl mx-auto border shadow rounded p-5 bg-white" @submit.prevent="onSubmit">
            <ckeditor v-model="form.content" :editor="editor" :config="editorConfig"></ckeditor>

            <div class="flex flex-wrap -mx-3 mb-6 mt-5">
                <div class="w-full px-3">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="images">
                        <div class="w-1/4">
                            <p class="bg-blue-500 px-2 py-2 text-white font-bold rounded text-center cursor-pointer">
                                Upload Image</p>
                        </div>
                    </label>
                </div>
            </div>

            <div v-if="form.images" class="flex flex-wrap -mx-3 my-6">
                <div class="w-full px-3 flex justify-center">
                    <img class="w-64 h-64 shadow p-5" :src="form.images" alt="">
                </div>
            </div>

            <div class="md:flex md:items-center">
                <div class="md:w-1/3">
                    <button
                        :class="button_color + ' shadow focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded'"
                        type="submit">
                        {{button_text}}
                    </button>
                </div>
                <div class="md:w-2/3"></div>
            </div>

            <input class="invisible" id="images" type="file" @change="onFileChange" />

        </form>
    </div>
</template>

<script>
    import ClassicEditor from '@ckeditor/ckeditor5-build-classic';

    class Errors {
        constructor() {
            this.errors = {};
        }

        get(field) {
            if (this.errors[field]) {
                return this.errors[field][0];
            }
        }

        save(errors) {
            this.errors = errors;
        }

        clear(field) {
            delete this.errors[field];
        }
    }
    export default {

        props: {
            user: {
                type: String
            }
        },

        data: function () {
            return {
                errors: new Errors(),
                button_text: 'Submit',
                button_color: 'bg-teal-400',
                form: {
                    images: null,
                    content: null

                },
                editor: ClassicEditor,
                editorConfig: {
                    // The configuration of the editor.
                },
            }
        },
        methods: {

            onFileChange(e) {
                const image = e.target.files[0];
                const reader = new FileReader();
                reader.readAsDataURL(image);
                reader.onload = e => {
                    this.form.images = e.target.result;
                    // this.url = null
                }
            },

            onSubmit() {
                if (!this.form.images) {
                    alert('Select Images')
                } else {
                    axios.post('/create-post', this.$data.form)

                        .then(response => {
                            this.button_text = 'Success'
                            this.button_color = 'bg-blue-500'
                            window.location.href = '/' + this.user;
                        })

                        .catch(error => {
                            if (error.response.status == 422) {
                                this.errors.save(error.response.data.errors);
                            }
                        })
                }
            }
        }

    }

</script>

<style scope>
    .ck-editor__editable {
        min-height: 250px;
    }

    h2 {
        display: block;
        font-size: 2em;
        margin-block-start: 0.67em;
        margin-block-end: 0.67em;
        margin-inline-start: 0px;
        margin-inline-end: 0px;
        font-weight: bold;
    }

    h3 {
        display: block;
        font-size: 1.5em;
        margin-block-start: 0.83em;
        margin-block-end: 0.83em;
        margin-inline-start: 0px;
        margin-inline-end: 0px;
        font-weight: bold;
    }

    h4 {
        display: block;
        font-size: 1.17em;
        margin-block-start: 1em;
        margin-block-end: 1em;
        margin-inline-start: 0px;
        margin-inline-end: 0px;
        font-weight: bold;
    }

</style>
