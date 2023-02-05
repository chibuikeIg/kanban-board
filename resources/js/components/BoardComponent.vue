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
                    <form class="form">
                        <div class="form__group">
                            <label class="form__group--label">Title</label>
                            <input type="text" name="title" class="form__group--form-control" placeholder="Enter board title">
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
        methods: {

            showAddColumnModal() {

                this.$modal.show("add-column-modal")

            }
        }
    }
</script>