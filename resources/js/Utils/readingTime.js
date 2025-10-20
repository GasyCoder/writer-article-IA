/**
 * Calculate reading time based on content
 * Average reading speed: 200 words per minute
 *
 * @param {string} content - The article content (can be markdown or plain text)
 * @returns {string} - Reading time in minutes (e.g., "2 min")
 */
export function calculateReadingTime(content) {
    if (!content) return '1 min';

    // Remove markdown syntax and HTML tags for accurate word count
    const plainText = content
        .replace(/[#*_~`>\[\]()]/g, '') // Remove markdown characters
        .replace(/<[^>]*>/g, '') // Remove HTML tags
        .replace(/\s+/g, ' ') // Normalize whitespace
        .trim();

    // Count words
    const words = plainText.split(/\s+/).length;

    // Calculate reading time (200 words per minute)
    const minutes = Math.ceil(words / 200);

    // Return formatted string
    return minutes === 1 ? '1 min' : `${minutes} min`;
}
