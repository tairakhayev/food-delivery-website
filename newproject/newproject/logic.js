function deleteUser(id) {

    // check existence of id
    if (!id) {
        return;
    }

    // check if user is sure
    const answer = confirm('Are you sure you want to delete this user?');
    if (!answer) {
        return;
    }

    // send delete request
    fetch('controllers/deleteUser.php?id=' + id, {
        method: 'DELETE',
    })

    // reload page after request is complete
    .then(response => {
        window.location.reload();
    });
}


function updateUserRole(id) {
    
    // check existence of id
    if (!id) {
        return;
    }

    // check if user is sure
    const answer = confirm('Are you sure you want to update this user?');
    if (!answer) {
        return;
    }

    // send update request
    fetch('controllers/updateRole.php?id=' + id, {
        method: 'PUT',
    })

    // reload page after request is complete
    .then(response => {
        window.location.reload();
    });

}