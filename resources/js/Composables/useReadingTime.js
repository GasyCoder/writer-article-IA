/**
 * Composable pour calculer le temps de lecture d'un article
 * Basé sur une vitesse moyenne de lecture de 200 mots par minute
 */
export function useReadingTime(content) {
    if (!content) return '1 min';

    // Retirer le markdown et HTML pour compter uniquement les mots
    const text = content
        .replace(/[#*_`~\[\]]/g, '') // Retirer les symboles markdown
        .replace(/<[^>]*>/g, '') // Retirer les balises HTML
        .replace(/\n/g, ' '); // Remplacer les sauts de ligne par des espaces

    // Compter les mots (séparés par des espaces)
    const words = text.trim().split(/\s+/).filter(word => word.length > 0);
    const wordCount = words.length;

    // Calculer le temps de lecture (200 mots/minute)
    const minutes = Math.ceil(wordCount / 200);

    // Retourner le format "X min read" ou "1 min read"
    return minutes === 1 ? '1 min' : `${minutes} min`;
}
