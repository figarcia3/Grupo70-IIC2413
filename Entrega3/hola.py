import pandas as pd
import psycopg2

df = pd.read_csv('users.csv')


try:
    conn = psycopg2.connect(
        database='grupo70e3',
        user='grupo70',
        password='grupo70'
    )

    cursor = conn.cursor()
    for a in range(len(df['pasaporte'].to_list())):

        row = df.iloc[a].to_list()

        query = f"INSERT INTO users VALUES ('{row[1]}','{row[2]}','{row[3]}','{row[4]}','{row[5]}','{row[6]}','{row[7]}','{row[8]}' )"
        cursor.execute(query)
        conn.commit()

    conn.close()

except Exception as e:
    print('There was an issue:')
    print(e)