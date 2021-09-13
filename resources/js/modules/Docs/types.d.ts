
export interface Page {
    category: String,
    page: String,
    subpage: String,
    content: String,
    toc: Array<String>
}

export interface Item {
    title: String,
    route: String
}