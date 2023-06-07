class SessionStorage {
    constructor() {}
    set(key, value) {
        sessionStorage.setItem(key, value);
    }
    get(key) {
        return sessionStorage.getItem(key);
    }
    remove(key) {
        sessionStorage.removeItem(key);
    }
    keyExists(key) {
        return this.get(key) !== null ? true : false;
    }
}

const storage = new SessionStorage();

export default storage;
