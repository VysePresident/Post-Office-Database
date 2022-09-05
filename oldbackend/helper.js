function rowclean(rows) {
    if (!rows) {
        return [];
    }
    return rows;
}

function getoffset(currentPage = 1, listPerPage) {
    return (currentPage - 1 ) * [listPerPage];
}

module.exports = {
    rowclean,
    getoffset
}