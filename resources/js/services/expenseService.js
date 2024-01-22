import axios from 'axios';

const API_URL = 'http://127.0.0.1:8000/api/';

class ExpenseService {
  getAll() {
    return axios
      .get(API_URL + 'expenses')
      .then(response => {
        return response.data
      });
  }
  destroyExpense(expenseId) {
    return axios
      .delete(API_URL + 'expenses/' + expenseId)
      .then(response => {
        return response
      });
  }

}
export default new ExpenseService();
