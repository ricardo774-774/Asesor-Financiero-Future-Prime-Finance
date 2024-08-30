import pandas as pd

def preprocess_data(data, user_id):
    user_data = data.query('id == @user_id')
    total_balance = user_data['Balance'].cumsum().values.tolist()
    fechas = pd.to_datetime(user_data['Fecha'], format='%Y-%m-%d')
    fechas = fechas.apply(lambda x: x.toordinal()).values.tolist()
    return (fechas, total_balance)