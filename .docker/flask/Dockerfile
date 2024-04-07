FROM python:3.9

COPY . /app
WORKDIR /app

RUN pip install Flask
RUN pip install -r requirements.txt

RUN pip install spacy && \
    python -m spacy download es_core_news_sm

EXPOSE 5000

RUN pip install debugpy
ENV PYTHONDONTWRITEBYTECODE 1
ENV PYTHONUNBUFFERED 1
ENV DEBIAN_FRONTEND=noninteractive

CMD ["python", "-m", "debugpy", "--listen", "0.0.0.0:5679", "app.py"]