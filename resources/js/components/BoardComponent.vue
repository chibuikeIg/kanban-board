<template>
    <div class="container__content">
        <div class="action-button">
            <a href="#" @click="showAddColumnModal()" class="action-button--add-btn">New Board</a>
            <a href="/export" class="action-button--export-btn">Export Board</a>
        </div>
        <div class="board">
            <div class="board__column" v-for="board in boards">
                <div class="board__column__header">
                    <h3 class="board__column__header--title">{{board.title}}</h3>
                    <div class="board__column__header--del-btn"><a href="#" @click="deleteBoard(board.id)">&times;</a></div>
                </div>
                <div class="board__column__body">
                    <draggable :list="board.cards" :options="{animation:300, handle:'.drag-btn', group:'visibility'}" @change="updateAllCard(board.cards, board.id)" @add="updateAllCard(board.cards, board.id)">
                        <div class="board__column__body--card" v-for="card in board.cards">
                            <div class="card-draggable">
                                <a href="#" class="drag-btn">Drag</a>
                            </div>
                            <div class="card-title">
                                <h4><a href="#" @click="showEditCardModal(card)">{{ card.title }}</a></h4>
                            </div>
                        </div>
                    </draggable>
                </div>
                <div class="board__column__footer">
                    <div class="board__column__footer--add-btn">
                        <a href="#" @click="showAddCardModal(board.id)">&plus;</a>
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
        <modal name="add-card-modal" :height="600">
            <div class="modal-container">
                <div class="modal-container__header">
                    <h3 class="container__header--title">Add Card</h3>
                </div>
                <div class="modal-container__body">
                    <form class="form"  @submit="createCard">
                        <div class="form__group">
                            <label class="form__group--label">Title</label>
                            <input type="text" name="title" ref="title" class="form__group--form-control el" placeholder="Enter board title">
                            <span class="form__group--text-danger title"></span>
                        </div>
                        <div class="form__group">
                            <label class="form__group--label">Description</label>
                            <textarea rows="10" name="description" ref="description" class="form__group--form-control el" placeholder="Write here..."></textarea>
                            <span class="form__group--text-danger description"></span>
                        </div>
                        <div class="form__group">
                            <label class="form__group--label">Status</label>
                            <select name="status" ref="status"  class="form__group--form-control el">
                                <option value="1">Active</option>
                                <option value="0">inactive</option>
                            </select>
                            <span class="form__group--text-danger status"></span>
                        </div>
                        <div class="form__group">
                            <input type="hidden"  ref="board_id">
                            <button type="submit" class="form__group--btn">Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </modal>
        <modal name="edit-card-modal" :height="650">
            <div class="modal-container">
                <div class="modal-container__header">
                    <h3 class="container__header--title">Edit Card</h3>
                </div>
                <div class="modal-container__body">
                    <form class="form"  @submit="updateCard">
                        <div class="form__group">
                            <label class="form__group--label">Title</label>
                            <input type="text" name="title" v-model="card.title" class="form__group--form-control el" placeholder="Enter board title">
                            <span class="form__group--text-danger title"></span>
                        </div>
                        <div class="form__group">
                            <label class="form__group--label">Description</label>
                            <textarea rows="10" name="description" v-model="card.description" ref="description" class="form__group--form-control el" placeholder="Write here..."></textarea>
                            <span class="form__group--text-danger description"></span>
                        </div>
                        <div class="form__group">
                            <label class="form__group--label">Status</label>
                            <select name="status" v-model="card.status" class="form__group--form-control el">
                                <template>
                                        <option value="1" :selected="card.status == 1">Active</option>
                                        <option value="0" :selected="card.status == 0">Inactive</option>
                                </template>
                            </select>
                            <span class="form__group--text-danger status"></span>
                        </div>
                        <div class="form__group">
                            <input type="hidden"  ref="card_id" v-model="card.id">
                            <button type="submit" class="form__group--btn">Save changes</button>
                            <button type="button" @click="deleteCard(card.id)" class="form__group--btn btn-danger">Remove card</button>
                        </div>
                    </form>
                </div>
            </div>
        </modal>
    </div>
</template>

<script>

    import axios from 'axios';
    import draggable from 'vuedraggable'

    export default {
        name: 'BoardComponent',
        components: {
            draggable,
        },

        data(){
            return {
                boards:[],
                board_id:null,
                card: {}
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
                
                axios.get('/boards').then(response=> {
                    this.boards= response.data
                })
            },

            createBoard(e) {

                e.preventDefault()

                axios.post('/boards', {title:this.$refs.title.value}).then(response=> {

                    this.$refs.title.value = ''
                    this.fetchBoards()
                    this.handleError([])
                    this.$modal.hide("add-column-modal")

                }).catch(err=> {
                    
                    this.handleError(err.response.data.errors)
                })
            },

            deleteBoard(id) {

                axios.delete('/boards/'+id).then(_=> {
                  
                  this.fetchBoards()
                  
                })
            },

            showAddCardModal(board_id) {
                this.$modal.show("add-card-modal")
                this.board_id = board_id
            },

            createCard(e) {

                e.preventDefault()
                
                let formData = {
                    title:this.$refs.title.value,
                    description: this.$refs.description.value,
                    board_id: this.board_id,
                    status: this.$refs.status.value
                }

                axios.post('/cards', formData).then(_=> {

                    this.fetchBoards()
                    this.handleError([])
                    this.$modal.hide("add-card-modal")

                }).catch(err=> {
                    
                    this.handleError(err.response.data.errors)
                })
            },

            

            showEditCardModal(card) {
                this.$modal.show("edit-card-modal")
                this.card = card
            },

            updateCard(e) {

                e.preventDefault()
                
                let formData = {
                    title: this.card.title,
                    description: this.card.description,
                    status: this.card.status
                }

                axios.put('/cards/'+this.card.id, formData).then(_=> {

                    this.fetchBoards()
                    this.handleError([])
                    this.$modal.hide("edit-card-modal")

                }).catch(err=> {
                    
                    this.handleError(err.response.data.errors)
                })
            },

            deleteCard(id) {

                axios.delete('/cards/'+id).then(_=> {

                    this.fetchBoards()
                    this.$modal.hide("edit-card-modal")

                })
            },

            updateAllCard(cards, board_id) {

                cards.map((card, index) => {
                    card.order = index +1
                    card.board_id = board_id
                })

                axios.put('/cards/update-all', {cards:cards})
            },

            handleError(err) {

                // get all the input fields with the class `.el`
                let input = document.querySelectorAll('.el'); 

                input.forEach((field) => {
            
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
            
                });
            }
        }
    }
</script>