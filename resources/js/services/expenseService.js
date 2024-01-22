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
  getExpense(expenseId) {
    return axios
      .get(API_URL + 'expenses/' + expenseId)
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
  createExpense(expenseData) {
    return axios
      .post(API_URL + 'expenses', {
        description: expenseData.description,
        value: Number(expenseData.value),
        date: expenseData.date
      })
      .then(response => {
        return response.data;
      });
  }
  editExpense(expenseData, editId) {
    return axios
      .put(API_URL + 'expenses/' + editId, {
        description: expenseData.description,
        value: Number(expenseData.value),
        date: expenseData.date
      })
      .then(response => {
        return response.data;
      });
  }

}
export default new ExpenseService();
