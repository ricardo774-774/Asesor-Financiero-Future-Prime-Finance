import requests
#import pytest
import pandas as pd
from preprocess import preprocess_data

url = 'http://127.0.0.1:5000/suggest_savings'
headers = {'Content-Type': 'application/json'}
test_data = pd.read_csv(r'data_100.csv')

def test_suggest_savings():
    X, y = preprocess_data(test_data, 1)
    data = {'fecha_historico': X, 'dinero_historico': y, 'dinero_meta': 50_000, 'fecha_meta': '24-12-2024'}
    response = requests.post(url, json=data, headers=headers)
    assert response.status_code == 200
    assert response.json()['ahorro_extra_mensual_necesario'] - 29.274355 < 1e-6
