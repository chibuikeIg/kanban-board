<template>
    <div class="container__content">
        <div class="action-button">
            <a href="#" class="action-button--add-btn">New Board</a>
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
    </div>
</template>