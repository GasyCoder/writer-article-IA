/**
 * Simple route helper function for Laravel routes
 * This provides basic routing functionality similar to Ziggy
 */

const routes = {
    'home': '/',
    'login': '/login',
    'register': '/register',
    'password.request': '/forgot-password',
    'password.email': '/forgot-password',
    'password.reset': '/reset-password',
    'verification.notice': '/verify-email',
    'logout': '/logout',
    'profile.edit': '/profile',
    'profile.update': '/profile',
    'profile.destroy': '/profile',
    'articles.index': '/articles',
    'articles.show': '/articles',
    'categories.index': '/categories',
    'categories.show': '/categories',
    'comments.store': '/articles',
    'admin.dashboard': '/admin/dashboard',
    'admin.articles.index': '/admin/articles',
    'admin.articles.create': '/admin/articles/create',
    'admin.articles.store': '/admin/articles',
    'admin.articles.show': '/admin/articles',
    'admin.articles.edit': '/admin/articles',
    'admin.articles.update': '/admin/articles',
    'admin.articles.destroy': '/admin/articles',
};

/**
 * Generate a URL for a named route
 * @param {string} name - The route name
 * @param {object|string|number} params - Route parameters (can be an object or a single value)
 * @returns {string} The generated URL
 */
export function route(name, params = {}) {
    let url = routes[name];

    if (!url) {
        console.warn(`Route "${name}" not found. Returning route name as fallback.`);
        return `/${name}`;
    }

    // If params is a single value (string or number), append it to the URL
    if (typeof params === 'string' || typeof params === 'number') {
        return `${url}/${params}`;
    }

    // If params is an object with properties
    if (typeof params === 'object' && params !== null && Object.keys(params).length > 0) {
        // For routes that need a parameter in the path (like articles.show)
        if (params.slug || params.id) {
            return `${url}/${params.slug || params.id}`;
        }

        // For query parameters
        const queryString = Object.keys(params)
            .map(key => `${encodeURIComponent(key)}=${encodeURIComponent(params[key])}`)
            .join('&');

        return queryString ? `${url}?${queryString}` : url;
    }

    return url;
}

export default route;
