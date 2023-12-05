const apiUrl = 'http://localhost:8000/api';
export async function fetchPosts() {
    const response = await fetch(apiUrl + '/posts', {
        headers: {
            Accept: "application/ld+json"
        }
    });
    const data = await response.json();
    return data['hydra:member'].map(item => ({
        id: item.id,
        author: item.author,
        message: item.message,
        createdAt: new Date(Date.parse(item.createdAt)),
    }));
}

export async function createPost({message, author}) {
    const post = {
        author,
        message,
        createdAt: new Date(),
    }

    const response = await fetch(apiUrl + '/posts', {
        method: "POST",
        headers: {
            "Accept": "application/ld+json",
            "Content-Type": "application/ld+json",
        },
        body: JSON.stringify(post),
    });

    const data = await response.json();

    return  {
        id: data.id,
        author: data.author,
        message: data.message,
        createdAt: new Date(Date.parse(data.createdAt)),
    };
}