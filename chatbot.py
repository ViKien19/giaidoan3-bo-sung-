from fastapi import APIRouter
from fastapi import FastAPI, File, UploadFile, Header, HTTPException, Request, Form  # noqa: E402, F401
from fastapi.responses import JSONResponse
from app.security.security import get_api_key
from app.models.base import Base
from langchain.schema import Document


from chatbot.services.files_chat_agent import FilesChatAgent  # noqa: E402
from app.config import settings
from ingestion.ingestion import Ingestion
import os


# Tạo router cho người dùng
router = APIRouter(prefix="/chatbot", tags=["chatbot"])


@router.post("/chatbot-datadb/") 
async def chatbot_datadb(
    api_key: str = get_api_key,  # Khóa API để xác thực
    name_database: str =Form(""),
    path_input_folder_: str =Form(""),
    question: str = Form(""),
):
    # chuẩn bị dữ liệu
    path_database = os.path.join(settings.DIR_ROOT,"utils","database",name_database)
    print("_",os.path.exists(path_database))
    if os.path.exists(path_database) is True:
        return  JSONResponse(status_code=200, content={"path": path_database,"mess":"database da ton tai"})    
    Ingestion("openai").ingestion_folder(
        path_input_folder= path_input_folder_,
        path_vector_store=path_database,
    )

    return  JSONResponse(status_code=200, content={"path": path_database,"mess":"to data thanh cong"})


@router.post("/chatbot-demo/")
async def chatbot_demo(
    api_key: str = get_api_key,
    question: str = Form(""),
    path_database: str = Form("D:/thuctapdoan/chatbot_nop/api_base_public/utils/database/demo_2"),
):

    settings.LLM_NAME = "openai"

    chat = FilesChatAgent(path_database).get_workflow().compile().invoke(
        input={"question": question}
    )

    # In ra để kiểm tra xem có phải là Document không
    print("=== DOCUMENT TYPE ===")
    for i, doc in enumerate(chat["documents"]):
        print(f"doc[{i}]:", type(doc))

    # Chuyển toàn bộ documents thành JSON serializable
    documents_serializable = []
    for doc in chat["documents"]:
        if isinstance(doc, Document):
            documents_serializable.append({
                "content": doc.page_content,
                "metadata": doc.metadata
            })
        else:
            documents_serializable.append(str(doc))  # fallback nếu không phải Document

    return JSONResponse(
        status_code=200,
        content={
            "generation": chat["generation"],
            "documents": documents_serializable,
        }
    )

