import AsyncStorage from '@react-native-async-storage/async-storage';

//Buscar os links salvos
export async function getLinksSave(key) {
    const myLinks = await AsyncStorage.getItem(key);
    let linksSaved = JSON.parse(myLinks) || [];

    return linksSaved
}
//Salvar um link no storage
export async function saveLink(key, newLink) {
    let linksStored = await getLinksSave(key);

    //se tiver algum link salvo com esse mesmo id / ou duplicado preciso ignorar.

    const hasLink = linksStored.some(link => link.id === newLink.id);
    if (hasLink) {
        console.log('esse link já existe na lista');
        return; //parar execução aqui.
    }
    linksStored.push(newLink);
    await AsyncStorage.setItem(key, JSON.stringify(linksStored));
    console.log('SALVO COM SUCESSO PARÇA');
}
//Deletar link
export async function deleteLink(links, id) {
    let myLinks = links.filter((item) => {
        return (item.id !== id)
    })

    await AsyncStorage.setItem('links', JSON.stringify(myLinks));

    console.log('Link deletado do storage');
    return myLinks;
}