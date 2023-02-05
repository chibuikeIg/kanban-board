<template>
    <div class="container__content">
        <div class="action-button">
            <a href="#" @click="showAddColumnModal()" class="action-button--add-btn">New Board</a>
        </div>
        <div class="board">
            <div class="board__column">
                <div class="board__column__header">
                    <h3 class="board__column__header--title">This is a column title</h3>
                    <div class="board__column__header--del-btn"><a href="#">&times;</a></div>
                </div>
                <div class="board__column__body">
                    <div class="board__column__body--card">
                        <div class="card-draggable">
                            <span>Drag</span>
                        </div>
                        <div class="card-title">
                            <h4>This is a card title</h4>
                        </div>
                    </div>
                </div>
                <div class="board__column__footer">
                    <div class="board__column__footer--add-btn">
                        <a href="#">&plus;</a>
                    </div>
                </div>
            </div>
        </div>
        <modal name="add-column-modal">
            <div class="modal-container">
                <div class="modal-container__header">
                    <h3 class="container__header--title">Add New Board</h3>
                </div>
                <div class="modal-container__body">
                    <form class="form" @submit="createBoard">
                        <div class="form__group">
                            <label class="form__group--label">Title</label>
                            <input type="text" name="title" ref="title" class="form__group--form-control el" placeholder="Enter board title">
                            <span class="form__group--text-danger title"></span>
                        </div>
                        <div class="form__group">
                            <button type="submit" class="form__group--btn">Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </modal>
    </div>
</template>

<script>
    export default {
        name: 'BoardComponent',

        data(){
            return {
                boards:[],
            }
        },

        created() {
            this.fetchBoards()
        },

        methods: {

            showAddColumnModal() {

                this.$modal.show("add-column-modal")

            },

            fetchBoards() {

            },

            createBoard(e) {

                e.preventDefault()

                this.$http.post('/boards', {title:this.$refs.title.value}).then(response=> {

                    this.$refs.title.value = ''
                    this.boards.push(response.data)
                    this.handleError([])

                }).catch(err=> {
                    
                    this.handleError(err.response.data.errors)
                })
            },

            handleError(err) {

                // get all the input fields with the class `.el`
                let input = document.querySelectorAll('.el'); 

                input.forEach( (field) => {
            
                    if(field.name) {
            
                        let selector = field.name.replace('[]', '')
            
                         // this will get any element (in our case span tag) that the class attribute value is same with the input tag name attribute value
                         let errorElement = document.querySelector('.'+selector);
            
                        // check if the input field has an error
                        if(err.hasOwnProperty(selector)) {
                            // replace the text content of the span tag with the error response message
                            errorElement.innerHTML = err[selector]; 
                        } else {
                            errorElement.innerHTML = ''; // else leave it empty or set it to display none.
                        }
            
                    }
            
                } );
            }
        }
    }
</script>