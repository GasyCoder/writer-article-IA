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
    'dashboard': '/dashboard',
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
 * @returns {string|object} The generated URL or route helper object
 */
export function route(name, params = {}) {
    // If called without arguments, return an object with helper methods
    if (name === undefined) {
        return {
            current: (routeName = null) => {
                const currentPath = window.location.pathname;

                // If no route name provided, return the current route name
                if (routeName === null) {
                    for (const [name, path] of Object.entries(routes)) {
                        if (currentPath === path || currentPath.startsWith(path + '/')) {
                            return name;
                        }
                    }
                    return null;
                }

                // If route name provided, check if current route matches
                const routePath = routes[routeName];
                if (!routePath) {
                    return false;
                }

                // Exact match or starts with route path (for dynamic routes)
                return currentPath === routePath || currentPath.startsWith(routePath + '/');
            }
        };
    }

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
