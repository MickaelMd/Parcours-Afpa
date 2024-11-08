class API {
  constructor(type) {
    this.type = type;
    this.baseUrl = `https://swapi.dev/api/${type}/`;
  }

  async fetchAll() {
    const response = await fetch(this.baseUrl);
    const data = await response.json();
    return data.results;
  }

  async fetchById(id) {
    const response = await fetch(`${this.baseUrl}${id}/`);
    const data = await response.json();
    return data;
  }

  async search(query) {
    const response = await fetch(`${this.baseUrl}?search=${query}`);
    const data = await response.json();
    return data.results;
  }
}
